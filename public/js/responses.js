const trigger = [
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
    ["bye", "good bye", "goodbye"]
];

const reply = [
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
    ["Goodbye", "See you later"]
]

const alternative = [
    "Same",
    "Go on...",
    "Try again",
    "I'm listening...",
    "Bro..."
];

const robot = [
    "How do you do, fellow human",
    "I am not a bot",
    "I hate bots! Of course not!",
    "If I was a bot my circuits would explode right now I'm so wet!",
];

function compare(triggerArray, replyArray, text) {
    let item;
    for (let x = 0; x < triggerArray.length; x++) {
        for (let y = 0; y < replyArray.length; y++) {
            if(triggerArray[x][y] == text) {
                items = replyArray[x];
                items = items[Math.floor(Math.random() * items.length)];
            }
        }
    }
    return item;
}
