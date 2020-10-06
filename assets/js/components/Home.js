import React, {Component} from 'react';;
import {Route, Switch, Redirect, Link, withRouter} from 'react-router-dom';
import Navbar from '../components/Navbar/Navbar';
import ImportDostaw from "./ImportDostaw";
import Konfiguracja from "./Konfiguracja";
import PodgladTrasy from "./PodgladTrasy";
import GeneratorTrasy from "./GeneratorTrasy";
import WysylanieOdbioru from "./WysylanieOdbioru";

class Home extends Component {
    render() {
        return (
            <div className={"home"}>
                <Navbar/>

                <Switch>
                    <Route path={"/import-dostaw"} component={ImportDostaw}/>
                    <Route path={"/konfiguracja"} component={Konfiguracja}/>
                    <Route path={"/podglad-trasy"} component={PodgladTrasy}/>
                    <Route path={"/generator-trasy"} component={GeneratorTrasy}/>
                    <Route path={"/wysylanie-odbioru"} component={WysylanieOdbioru}/>
                </Switch>
            </div>
        );
    }
}

export default Home;