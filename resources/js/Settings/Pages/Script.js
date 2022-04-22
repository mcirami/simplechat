import React, {useEffect, useState} from 'react';
import CodeMirror from '@uiw/react-codemirror';
import {getSetting, saveSetting} from '../Services/SettingsRequests';

const Script = () => {

    const [script, setScript] = useState("");

    useEffect(() => {

        const packets = {
            column: 'script'
        }

        getSetting(packets)
            .then((data) => {

                const array = data["script"];

                if (array) {
                    let savedScript = "";
                    array.map((line, i, row) => {
                        savedScript += line;
                        if (i + 1 !== row.length) {
                            savedScript += "\n";
                        }
                    });
                    setScript(savedScript);
                }
            })

    },[])

    const handleSubmit = () => {
        const array = script.split("\n");

        const packets = {
            column: 'script',
            script: array
        }

        saveSetting(packets);

    }

    return (
        <div>
            <h3>Script</h3>
            <div className="help_text">
                <p>One reply per line.</p>
            </div>
            <CodeMirror
                id="script"
                value={script}
                height="400px"
                options={{
                    mode:'jsx',
                    lineWrapping: true,
                }}
                onChange={(value) => {
                    setScript(value);
                }}
            />
            <a className="button red" href="#" onClick={handleSubmit}>
                Submit
            </a>
        </div>
    );
};

export default Script;
