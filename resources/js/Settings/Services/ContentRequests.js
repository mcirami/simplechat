import axios from 'axios';
import EventBus from '../Utils/Bus';

export const saveContent = async (packets) => {


    /*return await axios.post('/store-content', packets)
    .then(
        (response) => {
            const returnMessage = JSON.stringify(response.data.message);
            EventBus.dispatch("success", {message: returnMessage});
        })
    .catch((error) => {
        console.log(error)
    })*/

    try {
        const response = await axios.post('/store-content', packets);
        const returnMessage = JSON.stringify(response.data.message);
        EventBus.dispatch("success", {message: returnMessage});

    } catch (error) {

        console.error(error);
    }
}

export const getContent = async () => {

    try {
        const response = await axios.get('/get-content');
        const returnMessage = response.data;
        //EventBus.dispatch("success", {message: returnMessage});

        return returnMessage.data;

    } catch (err) {
        console.error(err);
    }
}

export const removeImage = async (packets) => {

    try {
        await axios.post('/remove-content-image', packets);
        /*const returnMessage = JSON.stringify(response.data.message);
        EventBus.dispatch("success", {message: returnMessage});*/
        return true;

    } catch (error) {
        console.error(error);
    }

}

export const getUsername = async () => {

    try {
        const response = await axios.get('/get-username');
        /*const returnMessage = JSON.stringify(response.data.message);
        EventBus.dispatch("success", {message: returnMessage});*/

        return response.data.username;


    } catch (err) {
        console.error(err);
    }
}

export const getAllUsersNames = async () => {

    try {
        const response = await axios.get('/get-all-user-names');
        /*const returnMessage = JSON.stringify(response.data.message);
        EventBus.dispatch("success", {message: returnMessage});*/

        return {
            success : true,
            data: response.data.data,
        }

    } catch (err) {
        console.error(err);
    }

}
