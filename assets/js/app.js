import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router } from 'react-router-dom';
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.js';
import '../css/app.css';
import '../css/app-custom.scss';
import Home from './components/Home';

ReactDOM.render(
    <Router>
        <Home />
    </Router>
    , document.getElementById('root'));
