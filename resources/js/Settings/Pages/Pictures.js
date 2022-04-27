import React, {useEffect, useState} from 'react';
import {getSetting} from '../Services/SettingsRequests';
import SubmitButton from '../Components/SubmitButton';

const Pictures = () => {

    const [imageArray, setImageArray] = useState(null);
    const [imagePreviewArray, setImagePreviewArray] = useState({});
    let count = 0;

    useEffect(() => {
        const packets = {
            column: 'images'
        }

        getSetting(packets)
        .then((data) => {

            const imageArray = data["images"];

            let objArray = {};
            for (let i in imageArray) {
                const objKey = Object.keys(imageArray[i]);
                objArray[objKey[0]] = imageArray[i][objKey[0]];
            }
            setImagePreviewArray(objArray);
        })

    },[])

    const onSelectFile = (e, picNumber) => {
        let files = e.target.files || e.dataTransfer.files;
        if (!files.length) {
            return;
        }

        const key = "image_" + picNumber;

        createImage(files[0], key);

        setImagePreviewArray({
            ...imagePreviewArray,
            [key]: URL.createObjectURL(files[0])
        });
    };

    const createImage = (file, key) => {

        let reader = new FileReader();
        reader.onload = (e) => {
            setImageArray({
                ...imageArray,
                [key] : e.target.result
            })
        };
        reader.readAsDataURL(file);
    };

    return (
        <>
            <h3>Outgoing Pictures</h3>
            <div className="help_text">
                <p>
                    {/*TOKEN: %p <br />*/}
                    Pictures will be sent in the order they are uploaded here, if chatter asks for a picture or if <span>%p</span> token is used in a message
                </p>
            </div>

            <div className="inputs_wrap">

                {[...Array(6)].map((e, index) => {

                    const picNumber = index + 1;
                    return (
                        <div className="input_column" key={index}>
                            <h3>Picture {picNumber}</h3>
                            <label className={ `${imagePreviewArray["image_" + picNumber] === undefined ? "img_placeholder" : ""}` }
                                   htmlFor={'image_' + picNumber + '_upload'}
                                   style={{
                                       backgroundImage: `url("${ imagePreviewArray["image_" + picNumber] ? imagePreviewArray["image_" + picNumber] : '/images/pic-placeholder.png' }")`,
                                       backgroundRepeat: `no-repeat`,
                                       backgroundSize: `cover`,
                                       backgroundPosition: `center`
                                   }}
                            >
                            </label>
                            <input
                                className="custom"
                                name={'image_' + picNumber}
                                id={'image_' + picNumber + '_upload'}
                                type="file"
                                accept="image/png, image/jpeg, image/jpg, image/gif"
                                onChange={(e) => onSelectFile(e, picNumber)}
                            />
                        </div>
                    )

                })}
            </div>

            <SubmitButton value={imageArray} column={"images"} setImageArray={setImageArray}/>

        </>
    );
};

export default Pictures;
