import React from 'react';
import {saveContent} from '../Services/ContentRequests';
import EventBus from '../Utils/Bus';

function ContentSubmit({username, imageArray, setImageArray, available}) {

    const handleSubmit = () => {

        if(available) {

            const packets = {
                username: username,
                imageArray: imageArray
            }

            saveContent(packets)
            .then((response) => {

                if(response.success) {
                    setImageArray({});
                }

            });

        } else {
            EventBus.dispatch("error", {message: "Username Not Available"});
        }
    }

    return (
        <div className="button_wrap">
            <a className="button red" href="#" onClick={handleSubmit}>
                Submit
            </a>
        </div>
    );
}

export default ContentSubmit;
