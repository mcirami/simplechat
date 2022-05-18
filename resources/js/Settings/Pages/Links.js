import React, {useState, useEffect} from 'react';
import CodeMirror from '@uiw/react-codemirror';
import {getSetting} from '../Services/SettingsRequests';
import SubmitButton from '../Components/SubmitButton';

const Links = () => {

    const [links, setLinks] = useState("");

    useEffect(() => {

        const packets = {
            column: 'links'
        }

        getSetting(packets)
        .then((data) => {

            const array = data["links"];

            if (array) {
                let savedScript = "";
                array.map((line, i, row) => {
                    savedScript += line;
                    if (i + 1 !== row.length) {
                        savedScript += "\n";
                    }
                });
                setLinks(savedScript);
            }
        })

    },[])

    return (
        <>
            <h3>Links</h3>
            <div className="help_text">
                <p>
                    TOKEN: %s <br />
                    If more than 1, Will be used in random order.
                </p>
            </div>
            <CodeMirror
                id="script"
                value={links}
                height="400px"
                options={{
                    mode:'jsx',
                    lineWrapping: true,
                }}
                onChange={(value) => {
                    setLinks(value);
                }}
            />

            <SubmitButton value={links} column={"links"}/>

        </>
    );
};

export default Links;
