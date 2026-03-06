import.meta.glob(["../images/**", "../audio/**"]);
import "./TruckerFM";
import { calcTime } from "./Time"

//Object storage for routes
const driverRoutes = {};

// --- CHANGE 1: Add a registry to remember driver colors ---
const assignedDriverColors = {};
const driverColors = ["blue", "red", "green", "orange", "purple", "teal"];
let colorIndex = 0;

let mapDiv = document.getElementById('map');


if (mapDiv !== null) {
    console.log(mapDiv);
    var map = L.map("map").setView([52.2, 5.64], 8);

    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution:
            '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    }).addTo(map);
}

console.log(map);

let formData;


// Driver id had to be added to arguments. ---- Fixed a bug meter : 01
async function route(stops, targetTime, timeMode, date, truckName, truckId) {
    // Origin is set to Urk by default
    const origin = [5.640616, 52.654189];

    try {
        // Get directions via API
        let response = await fetch('api/getDirections', {
            method: "POST",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
            },
            body: JSON.stringify({
                stops: stops,
                date: date,
                truck_id: truckId
            })
        });

        let responseJson = await response.json();
        let result = responseJson.original;

        const summary = result.features[0].properties.summary;

        // Make a string with the length of the route in km
        const totalDistanceKm = (summary.distance / 1000).toFixed(1) + " km";

        // Turn the duration into a string
        const hours = Math.floor(summary.duration / 3600);
        const minutes = Math.floor((summary.duration % 3600) / 60);
        const durationString = hours > 0 ? `${hours}h ${minutes}m` : `${minutes}m`;

        let targetTimeString = calcTime(summary.duration, targetTime, timeMode);

        let popupContent;
        if (timeMode === "depart_at") {
            popupContent = `
            <strong>Numberplate:</strong> ${truckName}<br>
            <strong>Departure:</strong> ${targetTime}<br>
                <strong>Duration:</strong> ${durationString}<br>
                <strong>Distance:</strong> ${totalDistanceKm}<br>
                <strong>Arrival:</strong> ${targetTimeString}<br>
            `;
        } else {
            popupContent = `
            <strong>Numberplate:</strong> ${truckName}<br>
            <strong>Departure:</strong> ${targetTimeString}<br>
                <strong>Duration:</strong> ${durationString}<br>
                <strong>Distance:</strong> ${totalDistanceKm}<br>
                <strong>Arrival:</strong> ${targetTime}<br>
            `;
        }


        //  Check if a driver has a route and remove that layer.
        if (driverRoutes[truckName]) {
            map.removeLayer(driverRoutes[truckName]);
        }
        // Already has a colour?
        let color;

        if (assignedDriverColors[truckName]) {
            // Use colour
            color = assignedDriverColors[truckName];
        } else {
            // If it's a new driver, pick the next available color
            color = driverColors[colorIndex];

            // Save it so they keep it next time
            assignedDriverColors[truckName] = color;

            // Index for the next driver
            colorIndex++;

            // reset
            if (colorIndex >= driverColors.length) {
                colorIndex = 0;
            }
        }

        // Create the new route layer.
        const newLayer = L.geoJSON(result, {
            style: {
                color: color,
                weight: 5,
                opacity: 0.7,


            },
        }).bindPopup(popupContent);

        // Add to map and on top of that save it to the object.
        driverRoutes[truckName] = newLayer;
        newLayer.addTo(map);

        // Save the route to the database
        let departure;

        if (timeMode === "depart_at") {
            departure = targetTime;
        } else {
            departure = targetTimeString;
        }

    } catch (e) {
        console.log("Routing failed (likely an invalid address):", e);
        alert("Routing failed! please check the address");
    }
}


const destinationForms = document.querySelectorAll(".driver-form");

destinationForms.forEach((Form) => {
    Form.addEventListener("submit", (e) => {
        e.preventDefault();

        let truckName = Form.dataset.truckName;

        if (!truckName) {
            console.error("No driver name found.");
            return;
        }

        // Get all data from the form
        formData = new FormData(Form);
        console.log(formData);

        let truckId = formData.get("truck_id");
        let stops = formData.getAll("destination[]");
        let time = formData.get("timeInput");
        let timeMode = formData.get("timeMode");
        let date = formData.get("dateInput");

        // If a destination is present, generate and display the route
        if (typeof formData.get("destination[]") !== "undefined") {

            route(stops, time, timeMode, date, truckName, truckId);
        } else {

            alert("Something went wrong");
        }
    });
});

const addStopButtons = document.querySelectorAll("[id^='addStop']");

console.log(addStopButtons);

addStopButtons.forEach((element) => {
    element.addEventListener("click", () => {
        let newForm = document.createElement("div");
        newForm.classList.add("mb-2", "relative");

        newForm.innerHTML = `
        <input type="text" name="destination[]" class="stop-input w-full pr-10 border rounded-lg block disabled:shadow-none dark:shadow-none appearance-none text-base sm:text-sm py-2 h-10 leading-[1.375rem] ps-3 bg-white dark:bg-white/10 dark:disabled:bg-white/[7%] text-zinc-700 disabled:text-zinc-500 placeholder-zinc-400 disabled:placeholder-zinc-400/70 dark:text-zinc-300 dark:disabled:text-zinc-400 dark:placeholder-zinc-400 dark:disabled:placeholder-zinc-500 shadow-xs border-zinc-200 border-b-zinc-300/80 disabled:border-b-zinc-200 dark:border-white/10 dark:disabled:border-white/5" label="Destination">
        
        <button type="button" class="absolute right-0 top-0 h-full px-3 text-zinc-400 hover:text-red-500 flex items-center justify-center cursor-pointer">
            ✕
        </button>
        `;

        newForm.querySelector("button").addEventListener("click", function () {
            newForm.remove();
        });

        console.log(newForm)

        element.parentElement.parentElement.children[5].appendChild(newForm);
    });
});
document.addEventListener('livewire:navigated', () => {

const openDialog = document.getElementById("openDialog");
const closeButton = document.getElementById("closeDialog");
const dialog = document.getElementById("dialog");

if (openDialog && dialog){

openDialog.addEventListener('click', (el) => {
    dialog.showModal();
    });
}

if(closeButton && dialog){

closeButton.addEventListener('click', (el) => {
    dialog.close();
        });
    }
});
