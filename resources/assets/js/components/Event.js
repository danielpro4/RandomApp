
import EventHandler from './EventHandler';

export default class Event {

    constructor (context) {
        this.context = context;
        this.handlers = [];
    }

    get handlerAdded() {
        if (!this._handlerAdded) {
            this._handlerAdded = new Event(this);
        }

        return this._handlerAdded;
    }

    add(handler, context) {
        if (context === void 0) { context = null; }

        this.handlers.push(new EventHandler(handler, context));

        this.onHandlerAdded(handler);
    }

    onHandlerAdded (handler) {
        this.handlerAdded.notify(handler);
    }

    notify () {
        var parameter = [];

        for (var _i = 0; _i < arguments.length; _i++) {
            parameter[_i] = arguments[_i];
        }

        var args = arguments;

        // Call each handler
        for (var i = 0; i < this.handlers.length; i++) {
            var evh = this.handlers[i];
            if (!evh.handler) {
                continue;
            }

            var result = evh.handler.apply(evh.context || this.context, args);
            if (typeof result !== 'undefined') {
                return result;
            }
        }
    }
}
