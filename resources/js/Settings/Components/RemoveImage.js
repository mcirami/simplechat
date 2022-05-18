import React from 'react';
import {BiX} from 'react-icons/bi';
import {deleteImage} from '../Services/SettingsRequests';

const RemoveImage = ({picNumber, imagePreviewArray, setImagePreviewArray, imageArray, setImageArray}) => {

    const handleClick = () => {

        if (!imageArray) {
            removeImage();
        } else {

            let found = false;
            let newImageArray = {...imageArray}
            let newPreviewArray = {...imagePreviewArray}

            const key = "image_" + picNumber;
            if(newImageArray.hasOwnProperty(key)) {
                found = true;
                delete newImageArray[key];
                delete newPreviewArray[key];
                setImageArray(newImageArray);
                setImagePreviewArray(newPreviewArray);
            }

            if (!found) {
                removeImage();
            }

        }
    }

    const removeImage = () => {

        const packets = {
            picNumber: picNumber
        }

        deleteImage(packets).then((data) => {
            if (data.success) {

                const imageObjArray = data["userImages"];

                if (imageObjArray) {
                    let objArray = {};
                    for (let i in imageObjArray) {
                        const objKey = Object.keys(imageObjArray[i]);
                        objArray[objKey[0]] = imageObjArray[i][objKey[0]];
                    }
                    setImagePreviewArray(objArray);
                } else {
                    setImagePreviewArray([])
                }
            }
        });
    }

    return (

        <div className="remove_button" onClick={handleClick}>
            <BiX />
        </div>

    );

};

export default RemoveImage;
