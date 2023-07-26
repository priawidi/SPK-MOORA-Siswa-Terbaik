$(document).ready(function () {

    const profile = document.querySelector('#profile');
    const timer = document.querySelector('#timer');
    const btnSubmit = document.querySelector('#btnSubmit');

    const startTimer = function () {
        const user_id = profile.dataset.userdata;
        getEndTime(user_id);
    }

    const getEndTime = async function (id) {
        try {
            const url = `http://localhost/disc-test/test/get_time_end?user_id=${id}`;
            const response = await fetch(url);
            const data = await response.json();

            displayCountDown(data.data)
        } catch (error) {
            throw (error);
        }
    }

    const displayCountDown = function (data) {
        let timeExpired = new Date(data.time_end).getTime();

        // Update the count down every 1 second
        let x = setInterval(function () {

            // Get today's date and time
            let now = new Date().getTime();

            // Find the distance between now and the count down date
            let distance = timeExpired - now;

            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            timer.innerHTML = minutes + " : " + seconds;

            // If the count down is over, write some text 
            if (distance < 0) {
                clearInterval(x);
                timer.innerHTML = 'Expired';
                btnSubmit.innerHTML = 'Test telah berakhir'
            }
        }, 1000);
    }

    startTimer();
});