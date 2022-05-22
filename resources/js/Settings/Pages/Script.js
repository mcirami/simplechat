import React, {useEffect, useState} from 'react';
import CodeMirror from '@uiw/react-codemirror';
import {getSetting} from '../Services/SettingsRequests';
import SubmitButton from '../Components/SubmitButton';
import {useOutletContext} from "react-router-dom";


const Script = () => {

    const [script, setScript] = useState("");
    const [activeStatus] = useOutletContext();

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
        <article className={!activeStatus ? "disabled" : ""}>
            <h3>Script</h3>
            <div className="help_text">
                <p>One reply per line. <br/>
                    Use <span>%s</span> token to insert a link from your Links settings<br />
                </p>
                <p className="mt-3">
                    Use <span>%p plus pic number</span> token to send a pic along with your message - <span>MUST INCLUDE PIC NUMBER</span>
                    <br />
                    ex: <span>%p1</span> will send image 1,  <span>%p2</span> will send image 2 etc...
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
        </article>
    );
};

export default Script;
