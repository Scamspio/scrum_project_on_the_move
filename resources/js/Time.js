function calcTime(duration, targetTime, timeMode) {

    let a = targetTime.split(':');
    const targetTimeSeconds = (+a[0]) * 60 * 60 + (+a[1] * 60);

    const time = timeMode === "depart_at"
        ? targetTimeSeconds + duration
        : targetTimeSeconds - duration;

    const hours = Math.floor(time / 3600);
    const minutes = Math.floor((time % 3600) / 60);

    const formattedHours = String(hours).padStart(2, "0");
    const formattedMinutes = String(minutes).padStart(2, "0");
    return `${formattedHours}:${formattedMinutes}`;

}

export { calcTime };