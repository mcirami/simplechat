import React, {useEffect, useState} from 'react';
import {getSetting, saveSetting} from '../Services/SettingsRequests';
import CodeMirror from '@uiw/react-codemirror';

const KeepAlive = () => {
    const [keepAlive, setKeepAlive] = useState("");

    useEffect(() => {

        const packets = {
            column: 'keep_alive'
        }

        getSetting(packets)
        .then((data) => {

            const array = data["keep_alive"];

            if (array) {
                let savedScript = "";
                array.map((line, i, row) => {
                    savedScript += line;
                    if (i + 1 !== row.length) {
                        savedScript += "\n";
                    }
                });
                setKeepAlive(savedScript);
            }
        })

    },[])

    const handleSubmit = () => {

        const array = keepAlive.split("\n");

        const packets = {
            column: 'keep_alive',
            keep_alive: array
        }

        saveSetting(packets);

    }

    return (
        <div>
            <h3>Keep Alive</h3>
            <div className="help_text">
                <p>
                    Keep-alive messages help to revive conversations that would otherwise not convert. If a user does not respond to the system within x amount of minutes, one of these messages will be sent.
                    ex: You still there?
                </p>
            </div>
            <CodeMirror
                id="script"
                value={keepAlive}
                height="400px"
                options={{
                    mode:'jsx',
                    lineWrapping: true,
                }}
                onChange={(value) => {
                    setKeepAlive(value);
                }}
            />
            <a className="button red" href="#" onClick={handleSubmit}>
                Submit
            </a>
        </div>
    );
};

export default KeepAlive;
