import React from 'react';
import {BiX} from 'react-icons/bi';
import {removeImage} from '../Services/ContentRequests';


const RemoveContentImage = ({type, setImagePreview, imagePreview, imageArray, setImageArray }) => {

    const handleClick = () => {

        if (!imageArray) {
            deleteImage();
        } else {
            let found = false;
            let newImageArray = {...imageArray}
            let newPreviewArray = {...imagePreview}

            if(newImageArray.hasOwnProperty(type)) {
                found = true;
                delete newImageArray[type];
                delete newPreviewArray[type];
                setImageArray(newImageArray);
                setImagePreview(newPreviewArray);
            }

            if (!found) {
                deleteImage();
            }
        }

    }

    const deleteImage = () => {

        const packets = {
            type: type
        }

        removeImage(packets)
        .then((response) => {

                if (response) {
                    setImagePreview({
                        ...imagePreview,
                        [type]: null
                    })
                }
            }
        )
    }

    return (

        <div className="remove_button" onClick={handleClick}>
            <BiX />
        </div>

    );
};

export default RemoveContentImage;
