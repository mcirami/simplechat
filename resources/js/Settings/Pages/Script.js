import React, {useEffect, useState} from 'react';
import CodeMirror from '@uiw/react-codemirror';
import {getSetting} from '../Services/SettingsRequests';
import SubmitButton from '../Components/SubmitButton';

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

    return (
        <>
            <h3>Script</h3>
            <div className="help_text">
                <p>One reply per line. <br/>
                    Use <span>%s</span> token to insert a link from your Links settings<br />
                    Use <span>%p</span> token to send a pic along with your message. (will send pics in order they are uploaded)
                </p>
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

            <SubmitButton value={script} column={"script"}/>
        </>
    );
};

export default Script;
