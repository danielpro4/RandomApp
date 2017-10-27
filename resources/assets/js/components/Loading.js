
import React, {Component} from 'react';

const Loader = function (props) {

    return (
        <dialog className="loading" ref="loading">
            <svg viewBox="0 0 32 32" width="32" height="32">
                <circle id="spinner" cx="16" cy="16" r="14" fill="none"></circle>
            </svg>
            <div className="loading-text">Cargando...</div>
        </dialog>
    );
};


export default Loader;