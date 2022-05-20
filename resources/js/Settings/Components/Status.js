import React, {useEffect, useState} from 'react';
import Switch from "react-switch";
import {getSetting, saveSetting} from '../Services/SettingsRequests';

const Status = ({activeStatus, setActiveStatus}) => {

    useEffect(() => {

        const packets = {
            column: 'active'
        }

        getSetting(packets)
        .then((data) => {

            const status = data["active"];
            setActiveStatus(status)
        })

    },[])

    const handleChange = () => {

        const packets = {
            column: 'active',
            active: !activeStatus ? 1 : 0
        }

        saveSetting(packets).then(() => {
            setActiveStatus(!activeStatus);
        });

    }

    return (

        <>
            <h3 className="mb-3">Bot/Manual Mode</h3>
            <div className="switch_row">
                <p>Manual</p>
                <Switch
                    onChange={handleChange}
                    height={20}
                    checked={Boolean(activeStatus)}
                    onColor="#b0273c"
                    uncheckedIcon={false}
                    checkedIcon={false}
                />
                <p>Bot</p>
            </div>
        </>

    );
};

export default Status;
