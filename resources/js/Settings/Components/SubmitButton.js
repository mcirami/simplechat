import React from 'react';
import {saveImages, saveSetting} from '../Services/SettingsRequests';

const SubmitButton = ({value, column, setImageArray}) => {

    const handleSubmit = () => {

        if (column === "images") {

            if (value) {

                const packets = {
                    files: value
                }

                saveImages(packets)
                .then((data) => {

                    if(data.success) {
                        setImageArray(null);
                    }
                })
            }

        } else {
            const array = value.split("\n");

            const packets = {
                column: column,
                [column]: array
            }

            saveSetting(packets);
        }

    }

    return (
        <div className="button_wrap">
            <a className="button red" href="#" onClick={handleSubmit}>
                Submit
            </a>
        </div>
    );
};

export default SubmitButton;
