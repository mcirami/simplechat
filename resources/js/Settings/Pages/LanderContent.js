import React, {useEffect, useState} from 'react';
import ContentSubmit from '../Components/ContentSubmit';
import RemoveContentImage from '../Components/RemoveContentImage';
import {
    getAllUsersNames,
    getContent,
    getUsername,
    saveContent,
} from '../Services/ContentRequests';
import EventBus from '../Utils/Bus';

const LanderContent = () => {

    // sets the preview after image selected and sets saved images on page load
    const [imagePreview, setImagePreview] = useState({});
    // sets the images ready to upload and references if there's images ready to know if deleting from DB or just the state
    const [imageArray, setImageArray] = useState({});
    const [username, setUsername] = useState(null);
    const [allUserNames, setAllUserNames] = useState(null);
    const [available, setAvailability] = useState(true);

    const host = window.location.origin;

    const fetchAllContent = async () => {

        const responses = await Promise.allSettled([getUsername(), getContent()]);

        setUsername(
            responses[0]['value'] || null
        );

        setImagePreview({
            background: responses[1]['value']["background"] || null,
            attachment: responses[1]['value']["attachment"] || null,
            profile: responses[1]['value']["profile"] || null
        })
    }

    useEffect(() => {
        fetchAllContent();
    },[])

    useEffect(() => {

        getAllUsersNames()
        .then((response) => {

            if (response.success) {
                setAllUserNames(response.data);
            }
        })

    }, [])

    const handleSubmit = () => {

        if(available) {

            const packets = {
                username: username,
                imageArray: imageArray
            }

            saveContent(packets);

            setImageArray({});
        } else {
            EventBus.dispatch("error", {message: "Username Not Available"});
        }
    }

    const onSelectFile = (e, type) => {
        let files = e.target.files || e.dataTransfer.files;
        if (!files.length) {
            return;
        }

        //const key = "image_" + picNumber;

        createImage(files[0], type);

        setImagePreview({
            ...imagePreview,
            [type] : URL.createObjectURL(files[0])
        })

    };

    const createImage = (file, type) => {

        let reader = new FileReader();
        reader.onload = (e) => {

            setImageArray({
                ...imageArray,
                [type] : e.target.result
            })
        };
        reader.readAsDataURL(file);
    };

    const handelChange = (e) => {

        let value = e.target.value.toLowerCase();
        const match = allUserNames.findIndex((element) => {
            return element.toLowerCase() === value;
        });

        if (match < 0 && value.length > 2) {
            setAvailability(true);
        } else {
            setAvailability(false);
        }

        setUsername(e.target.value)
    }

    return (
        <article className="edit_profile">

            <div className="input_row">
                <h3>Username <small>(must be unique)</small></h3>
                <input className="shadow-sm border-gray-300 rounded-md"
                       type="text"
                       placeholder="username"
                       defaultValue={username}
                       onKeyDown={ event => {
                           if(event.key === 'Enter') {
                               handleSubmit(event);
                           }
                       }
                       }
                       onChange={handelChange}
                />
                <p className={available ? "green" : "red"}>
                    {available ? "Available" : "Not Available"}
                </p>
            </div>
            <div className="link_row">
                <h3>Preview Links</h3>
                <p><a target="_blank" href={host + '/register?add=' + username}>{host + '/register?add=' + username}</a></p>
                <p><a target="_blank" href={host + '/register-two?add=' + username}>{host + '/register-two?add=' + username}</a></p>
                <p><a target="_blank" href={host + '/register-three?add=' + username}>{host + '/register-three?add=' + username}</a></p>
                <p><a target="_blank" href={host + '/register-four?add=' + username}>{host + '/register-four?add=' + username}</a></p>
            </div>
            <div className="inputs_wrap w-100">
                <div className="column">
                    <h3>Profile Image</h3>
                    <div className="content_wrap">
                        {imagePreview["profile"] &&

                            <RemoveContentImage
                                type="profile"
                                setImagePreview={setImagePreview}
                                imagePreview={imagePreview}
                                imageArray={imageArray}
                                setImageArray={setImageArray}
                            />
                        }
                        <label className={ `${ !imagePreview["profile"] ? "img_placeholder" : ""}`}
                               htmlFor="profile_image"
                               style={{
                                   backgroundImage: `url("${ imagePreview["profile"] || '/images/pic-placeholder.png' }")`,
                                   backgroundRepeat: `no-repeat`,
                                   backgroundSize: `cover`,
                                   backgroundPosition: `center`
                               }}
                        >
                        </label>
                        <input
                            className="custom"
                            name="profile_image"
                            id="profile_image"
                            type="file"
                            accept="image/png, image/jpeg, image/jpg, image/gif"
                            onChange={(e) => onSelectFile(e, "profile")}
                        />
                    </div>
                </div>
                <div className="column">
                    <h3>Background Image</h3>
                    <div className="content_wrap">
                        {imagePreview["background"] &&

                            <RemoveContentImage
                                type="background"
                                setImagePreview={setImagePreview}
                                imagePreview={imagePreview}
                                imageArray={imageArray}
                                setImageArray={setImageArray}
                            />
                        }
                        <label className={ `${ !imagePreview["background"] ? "img_placeholder" : ""}`}
                               htmlFor="background_image"
                               style={{
                                   backgroundImage: `url("${ imagePreview["background"] || '/images/pic-placeholder.png' }")`,
                                   backgroundRepeat: `no-repeat`,
                                   backgroundSize: `cover`,
                                   backgroundPosition: `center`
                               }}
                        >
                        </label>
                        <input
                            className="custom"
                            name="background_image"
                            id="background_image"
                            type="file"
                            accept="image/png, image/jpeg, image/jpg, image/gif"
                            onChange={(e) => onSelectFile(e, "background")}
                        />
                    </div>
                </div>
                <div className="column">
                    <h3>Attachment Image</h3>
                    <div className="content_wrap">
                        {imagePreview["attachment"] &&

                            <RemoveContentImage
                                type="attachment"
                                setImagePreview={setImagePreview}
                                imagePreview={imagePreview}
                                imageArray={imageArray}
                                setImageArray={setImageArray}
                            />
                        }
                        <label className={`${ !imagePreview["attachment"] ? "img_placeholder" : ""}`}
                               htmlFor="attachment_image"
                               style={{
                                   backgroundImage: `url("${ imagePreview["attachment"] || '/images/pic-placeholder.png' }")`,
                                   backgroundRepeat: `no-repeat`,
                                   backgroundSize: `cover`,
                                   backgroundPosition: `center`
                               }}
                        >
                        </label>
                        <input
                            className="custom"
                            name="attachment_image"
                            id="attachment_image"
                            type="file"
                            accept="image/png, image/jpeg, image/jpg, image/gif"
                            onChange={(e) => onSelectFile(e, "attachment")}
                        />
                    </div>
                </div>
            </div>

            <ContentSubmit
                username={username}
                imageArray={imageArray}
                setImageArray={setImageArray}
                available={available}
            />

        </article>
    );
};

export default LanderContent;
