import React, {useEffect, useState} from 'react';
import {getSetting, saveImages} from '../Services/SettingsRequests';

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

    const handleSubmit = (e) => {
        e.preventDefault();

        if (imageArray) {

            const packets = {
                files: imageArray
            }

            saveImages(packets)
                .then((data) => {

                    if(data.success) {
                        setImageArray(null);
                    }
            })
        } else {
            console.log("nope");
        }
    };

    return (
        <div>
            <h3>Outgoing Pictures</h3>
            <div className="help_text">
                <p>
                    {/*TOKEN: %p <br />*/}
                    Pictures will be sent in the order they are uploaded here, if chatter asks for a picture.
                </p>
            </div>
            <form onSubmit={handleSubmit} className="image_form">
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
                                    {/*<img className={ `${imagePreviewArray["image_" + picNumber] === undefined ? "img_placeholder" : ""}` }
                                         src={ imagePreviewArray["image_" + picNumber] ? imagePreviewArray["image_" + picNumber] : '/images/pic-placeholder.png'}
                                         alt=""
                                    />*/}
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

                <button type="submit" className="button red">
                    Submit
                </button>

            </form>
        </div>
    );
};

export default Pictures;
