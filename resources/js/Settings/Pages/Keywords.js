import React, {useEffect, useState} from 'react';
import CodeMirror from '@uiw/react-codemirror';
import {saveSetting, getSetting} from '../Services/SettingsRequests';

const Keywords = () => {

    const [keywords, setKeywords] = useState("");

    useEffect(() => {
        const packets = {
            column: 'keywords'
        }

        getSetting(packets)
        .then((data) => {

            const array = data["keywords"];

            if (array) {
                let savedKeywords = "";
                array.map((line, i, row) => {
                    savedKeywords += line;
                    if (i + 1 !== row.length) {
                        savedKeywords += "\n";
                    }
                });
                setKeywords(savedKeywords);
            }
        })

    },[])

    const handleSubmit = () => {
        const array = keywords.split("\n");

        const packets = {
            column: 'keywords',
            keywords: array,
        }

        saveSetting(packets)
        .then((data) => {
            if (data.message) {
                console.log(data.message)
            }
        })

    }

    return (
        <div>
            <h3>Keywords</h3>
            <div className="help_text">
                <p>Keywords make conversations seem more realistic by responding in a way the script normally would not.<br />
                    ex: talk later|Sure, I'll be here|Yup, message me anytime!<br />
                    FORMAT: KEYWORD|RESPONSE-1|RESPONSE-2<br />
                </p>
            </div>
            <CodeMirror
                id="script"
                value={keywords}
                height="400px"
                options={{
                    mode:'jsx',
                    lineWrapping: true,
                }}
                onChange={(value) => {
                    setKeywords(value);
                }}
            />
            <a className="button red" href="#" onClick={handleSubmit}>
                Submit
            </a>
        </div>
    );
};

export default Keywords;
