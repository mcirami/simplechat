import React, {useEffect, useState} from 'react';
import CodeMirror from '@uiw/react-codemirror';
import {getSetting} from '../Services/SettingsRequests';
import SubmitButton from '../Components/SubmitButton';
import {useOutletContext} from "react-router-dom";

const Keywords = () => {

    const [keywords, setKeywords] = useState("");
    const [activeStatus] = useOutletContext();

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
        <article className={!activeStatus ? "disabled" : ""}>
            <h3>Keywords</h3>
            <div className="help_text">
                <p>Keywords make conversations seem more realistic by responding in a way the script normally would not.<br />
                    ex: talk later|Sure, I'll be here|Yup, message me anytime!<br />
                    FORMAT: <span>KEYWORD|RESPONSE-1|RESPONSE-2</span>
                </p>
                <p className="mt-3">
                    Use <span>%p plus pic number</span> token to send a pic along with your message - <span>MUST INCLUDE PIC NUMBER</span>
                    <br />
                    ex: <span>%p1</span> will send image 1,  <span>%p2</span> will send image 2 etc...
                </p>
                <p className="mt-3">
                    Use <span>%n</span> token to display models name<br/>
                    Use <span>%a</span> token to display models age
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
        </article>
    );
};

export default Keywords;
