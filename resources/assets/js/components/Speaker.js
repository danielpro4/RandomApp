import Observer from "./Event";

export default class Speaker {

    constructor() {

        this.ssu = new SpeechSynthesisUtterance();

        this.ssu.valume = 1;

        this.completed = new Observer(this);

        this.ssu.onend = () => {
            this.completed.notify();
        }
    }

    /**
     * Make browser speak.
     * @param {string} message
     */
    speak(message) {
        var secureMessage = new String(message);
        this.ssu.text = secureMessage.toString();
        window.speechSynthesis.speak(this.ssu);
    }

    /**
     * Set speaker speaker.
     * @param {string} name Pauline | Juan
     */
    setSpeaker(name) {
        var voices = speechSynthesis.getVoices();

        voices.forEach(voice => {
            if (voice.name === name) {
                this.ssu.voice = voice;
            }
        });
    }

    /**
     * Set speaker volume.
     *
     * @param {number} volume 0 to 1
     */
    setVolume(volume) {
        if ("number" === typeof volume) {
            this.ssu.volume = volume;
        }
    }

    /**
     * Set speaker rate.
     *
     * @param {number} rate 0.1 to 10
     */
    setRate(rate) {
        if ("number" === typeof rate) {
            this.ssu.rate = rate;
        }
    }

    /**
     * Set speaker pitch.
     *
     * @param {number} pitch
     */
    setPitch(pitch) {
        if ("number" === typeof pitch) {
            this.ssu.pitch = pitch;
        }
    }

}