import axios from 'axios';
/*

const getAllScripts = async (scriptPackets) => {

    try {
        const response = await axios.post('/get-setting', scriptPackets);

        return response.data;

    } catch (err) {
        console.error(err);
    }
}

const getScriptTracking = async (trackingPackets) => {

    try {
        const scriptTracking = await axios.post('/script-tracking', trackingPackets)
        return scriptTracking.data;

    } catch (err) {
        console.error(err);
    }
}

export const getScript = async (scriptPackets, trackingPackets) => {

    try {

        return await axios.post('/get-setting', scriptPackets)
        .then( async (response) => {
            const index = await axios.post('/script-tracking', trackingPackets)

            //console.log(response.data.script[index.data.index]);
            return response.data.script[index.data.index]
        })
    } catch (err) {
        console.error(err);
    }
}
*/

/*export const getScript = (scriptPackets, trackingPackets) {

     return getAllScripts(scriptPackets).then(script => {

         return getScriptTracking(trackingPackets).then(index => {

             return script['script'][index['index']];

        })
    })*/

    /*try {
        const response = await axios.post('/get-setting', scriptPackets);

        if (response)  {
            const script = response.data;

            const response2 = await axios.post('/script-tracking', trackingPackets)

            if (response2) {
                const index = response2.data;

                //console.log(script['script'][index['index']]);
                return script['script'][index['index']]
            }
        }

    } catch (err) {
        console.error(err);
    }*/
//}

/*
export const getScript = async (scriptPackets, trackingPackets) => {

    const options = {
        method: 'POST',
        headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(
            scriptPackets
        )
    }

    const script = await fetch('/get-setting', options)
    .then(response => response.json())
        .then(() => {
        console.log(script)
            return script;
    });

    const options2 = {
        method: 'POST',
        headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(
            trackingPackets
        )
    }

    const index = await fetch('/script-tracking', options2)
    .then(response => response.json())
    .then(() => {
        console.log(index)
        return index;
    });
}

*/

export const getKeywords = (packets, access_token) => {

    /*try {
        const response = await axios.post('/get-setting', packets);

        return response.data;

    } catch (err) {
        console.error(err);
    }*/

    let keywords = $.ajax({
        url: "/get-setting",
        method: "POST",
        data: {_token: access_token, packets},
        dataType: "JSON",
        global: false,
        async:false,
        success: (data) => {
            console.log(data);
            return data;
        },
        error: (error) => {
            console.log(error);
        },
    }).responseJSON

    return keywords;
}

export const trigger = [
//0
    ["hi", "hey", "hello"],
//1
    ["how are you", "how are things"],
//2
    ["what is going on", "what is up"],
//3
    ["happy", "good", "well", "fantastic", "cool"],
//4
    ["bad", "bored", "tired", "sad"],
//5
    ["tell me story", "tell me joke"],
//6
    ["thanks", "thank you"],
//7
    ["bye", "good bye", "goodbye"],

    ["fuck you"],

    ["fuck off"]


];

export const reply = [
    //0
    ["Hello!", "Hi!", "Hey!", "Hi there!"],
//1
    [
        "Fine... how are you?",
        "Pretty well, how are you?",
        "Fantastic, how are you?"
    ],
//2
    [
        "Nothing much",
        "Exciting things!"
    ],
//3
    ["Glad to hear it"],
//4
    ["Why?", "Cheer up buddy"],
//5
    ["What about?", "Once upon a time..."],
//6
    ["You're welcome", "No problem"],
//7
    ["Goodbye", "See you later"],

    ["mhhm fuck me ;)", "you wanna fuck me ?? lolz", "yes let's do it!"],

    ["No fuck me please!"],

]

export const alternative = [
    "Same",
    "Go on...",
    "Try again",
    "I'm listening...",
    "Bro..."
];

export const robot = [
    "How do you do, fellow human",
    "I am not a bot",
    "I hate bots! Of course not!",
    "If I was a bot my circuits would explode right now I'm so wet!",
];
