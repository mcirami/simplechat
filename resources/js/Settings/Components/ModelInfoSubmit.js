import React from 'react';
import {saveModelInfo} from '../Services/SettingsRequests';

const ModelInfoSubmit = ({age, name}) => {


    const handleSubmit = () => {

        const packets = {
            age: age,
            name: name
        }

        saveModelInfo(packets);

    }

    return (
        <div className="button_wrap">
            <a className="button red" href="#" onClick={handleSubmit}>
                Submit
            </a>
        </div>
    );
};

export default ModelInfoSubmit;
