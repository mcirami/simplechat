import React, {useState, useEffect} from 'react';
import CodeMirror from '@uiw/react-codemirror';
import {getSetting} from '../Services/SettingsRequests';
import SubmitButton from '../Components/SubmitButton';
import {useOutletContext} from "react-router-dom";

const Links = () => {

    const [links, setLinks] = useState("");
    const [activeStatus] = useOutletContext();

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
        <article className={!activeStatus ? "disabled" : ""}>
            <h3>Links</h3>
            <div className="help_text">
                <p>
                    TOKEN: <span>%s</span> <br />
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

        </article>
    );
};

export default Links;
