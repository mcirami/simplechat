$(document).ready(function () {

    const pathName = window.location.pathname;

    if (pathName.includes('register-four')) {
        let typingIndicator = document.querySelector('.typing-indicator');
        const messageOne = document.querySelector('#first_message');
        const messageTwo = document.querySelector('#second_message');
        const thirdMessage = document.querySelector('#third_message');

        function sleep(time) {
            return new Promise(resolve => {
                setTimeout(resolve, time)
            })
        }

        sleep(3000)
        .then(() => {
            typingIndicator.style.display = "block";
            return sleep(3000);
        }).then(() => {
            typingIndicator.style.display = "none";
            messageOne.style.display = "flex";
            return sleep(3000);
        }).then(() => {
            typingIndicator.style.display = "block";
            return sleep(3000);
        }).then(() => {
            typingIndicator.style.display = "none";
            messageTwo.style.display = "flex";
            return sleep(3000);
        }).then(() => {
            typingIndicator.style.display = "block";
            return sleep(3000);
        }).then(() => {
            typingIndicator.style.display = "none";
            thirdMessage.style.display = "block";
            return sleep(3000);
        }).then(() => {
            document.querySelector(
                '#register_form').style.display = "block";
            document.querySelector(
                '.form_wrap.register').style.display = "flex";
        });
    }
});
