import React, {useEffect, useState} from 'react';
import {getSetting} from '../Services/SettingsRequests';
import SubmitButton from '../Components/SubmitButton';
import RemoveImage from '../Components/RemoveImage';
import {useOutletContext} from "react-router-dom";

const Pictures = () => {

    const [imageArray, setImageArray] = useState(null);
    const [imagePreviewArray, setImagePreviewArray] = useState({});
    const [activeStatus] = useOutletContext();

    useEffect(() => {
        const packets = {
            column: 'images'
        }

        getSetting(packets)
        .then((data) => {

            const imageObjArray = data["images"];

            let objArray = {};
            for (let i in imageObjArray) {
                const objKey = Object.keys(imageObjArray[i]);
                objArray[objKey[0]] = imageObjArray[i][objKey[0]];
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
        <article className={!activeStatus ? "disabled" : ""}>
            <h3>Outgoing Pictures</h3>
            <div className="help_text">
                <p>
                    Pictures will be sent according to pic number used with token <span>%p</span> in script or keywords.<br />
                    ex: %p1 will send image 1, %p2 will send image 2 etc...
                </p>
            </div>

            <div className="inputs_wrap">

                {[...Array(6)].map((e, index) => {

                    const picNumber = index + 1;
                    const imagePreview = imagePreviewArray["image_" + picNumber];
                    return (
                        <div key={index}>
                            <h3>Picture {picNumber}</h3>
                            <div className="content_wrap">
                                {imagePreview &&

                                    <RemoveImage
                                        picNumber={picNumber}
                                        imagePreviewArray={imagePreviewArray}
                                        setImagePreviewArray={setImagePreviewArray}
                                        imageArray={imageArray}
                                        setImageArray={setImageArray}

                                    />
                                }
                                <label className={ `${imagePreview === undefined ? "img_placeholder" : ""}` }
                                       htmlFor={'image_' + picNumber + '_upload'}
                                       style={{
                                           backgroundImage: `url("${ imagePreview || '/images/pic-placeholder.png' }")`,
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
                        </div>
                    )

                })}
            </div>

            <SubmitButton value={imageArray} column={"images"} setImageArray={setImageArray}/>

        </article>
    );
};

export default Pictures;
