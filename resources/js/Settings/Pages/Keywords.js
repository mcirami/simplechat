import React, {useEffect, useState} from 'react';
import CodeMirror from '@uiw/react-codemirror';
import {getSetting} from '../Services/SettingsRequests';
import SubmitButton from '../Components/SubmitButton';

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

    return (
        <>
            <h3>Keywords</h3>
            <div className="help_text">
                <p>Keywords make conversations seem more realistic by responding in a way the script normally would not.<br />
                    ex: talk later|Sure, I'll be here|Yup, message me anytime!<br />
                    FORMAT: KEYWORD|RESPONSE-1|RESPONSE-2<br />
                    Use <span>%p</span> token to send a pic along with your message. (will send pics in order they are uploaded)
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
            <SubmitButton value={keywords} column={"keywords"} />
        </>
    );
};

export default Keywords;
