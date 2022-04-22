import axios from 'axios';
import EventBus from '../Utils/Bus';

export const saveSetting = async (packets) => {

    try {
        const response = await axios.post('/store-setting', packets);
        const returnMessage = JSON.stringify(response.data.message);
        EventBus.dispatch("success", {message: returnMessage});

    } catch (err) {
        console.error(err);
    }

}

export const getSetting = async (packets) => {

    const response = await axios.post('/get-setting', packets);

    return response["data"];
}

export const saveImages = async (packets) => {

    return await axios.post('/store-image', packets)
        .then(
        (response) => {
            const returnMessage = JSON.stringify(response.data.message);
            EventBus.dispatch("success", {message: returnMessage});

            return {
                success: true,
            }
        }
    ).catch(error => {
        console.error(error);
    });
}
