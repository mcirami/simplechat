import React, {useState, useEffect} from 'react';
import SubmitButton from '../Components/SubmitButton';
import {useOutletContext} from "react-router-dom";
import ModelInfoSubmit from '../Components/ModelInfoSubmit';
import {getModelInfo, saveModelInfo} from '../Services/SettingsRequests';

const ModelInfo = () => {


    const [name, setName] = useState(null);
    const [age, setAge] = useState(null);
    const [activeStatus] = useOutletContext();

    useEffect(() => {

        getModelInfo()
        .then((response) => {

            setName(response.name);
            setAge(response.age);
        })

    }, [])

    const handleNameChange = (e) => {
        setName(e.target.value);
    }

    const handleAgeChange = (e) => {
        setAge(e.target.value);
    }

    const handleSubmit = () => {

        const packets = {
            age: age,
            name: name
        }

        saveModelInfo(packets);

    }

    return (

        <article className={!activeStatus ? "disabled" : ""}>
            <h3>Model Info</h3>
            <div className="help_text">
                <p>Model info can be used in your scripts and keywords.</p>
                <p className="mt-3">
                    <span>%n</span> token can be used for model's name
                </p>
                <p>
                    <span>%a</span> token an be used for model's age
                </p>
            </div>
            <div className="inputs_wrap">
                <div className="column">
                    <h3>Name</h3>
                    <input className="shadow-sm border-gray-300 rounded-md w-100"
                           type="text"
                           placeholder="name"
                           defaultValue={name}
                           onKeyDown={ event => {
                               if(event.key === 'Enter') {
                                   handleSubmit(event);
                               }
                           }
                           }
                           onChange={(e) => handleNameChange(e)}
                    />
                </div>
                <div className="column">
                    <h3>Age</h3>
                    <input className="shadow-sm border-gray-300 rounded-md w-100"
                           type="text"
                           placeholder="age"
                           defaultValue={age}
                           onKeyDown={ event => {
                               if(event.key === 'Enter') {
                                   handleSubmit(event);
                               }
                           }
                           }
                           onChange={(e) => handleAgeChange(e)}
                    />
                </div>
            </div>

            <ModelInfoSubmit age={age} name={name} />

        </article>
    );
};

export default ModelInfo;
