import React, {useState, useEffect} from 'react';
import CodeMirror from '@uiw/react-codemirror';
import {getSetting, saveSetting} from '../Services/SettingsRequests';

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

    const handleSubmit = () => {

        const array = links.split("\n");

        const packets = {
            column: 'links',
            links: array
        }

        saveSetting(packets);

    }

    return (
        <div>
            <h3>Links</h3>
            <div className="help_text">
                <p>
                    TOKEN: %s <br />
                    If more than 1, Will be used in random order unless you specify which link (see example).
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
            <a className="button red" href="#" onClick={handleSubmit}>
                Submit
            </a>
        </div>
    );
};

export default Links;
