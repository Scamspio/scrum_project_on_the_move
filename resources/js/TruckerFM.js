const switches = document.querySelectorAll('.switch');

// Geen double assignments meer.
const urkStream = "https://urk.fm/urkfm.mp3";
const audioPlayer = new Audio(urkStream);

function onSwitch (id, checked) {
    if (checked) {
        // Check if the other switch is already 'checked'
        if (switches[+!id].classList.contains('checked')) {
            console.log('on!');
            
            // audioplayer.load so it loads to the live feed.
            audioPlayer.load(); 
            audioPlayer.play();
        }
    } else {
        console.log('off');
        audioPlayer.pause();
    }
}

switches.forEach(e => {
    e.addEventListener('click', () => {
        onSwitch(parseInt(e.id), e.classList.toggle('checked'));
    });
});