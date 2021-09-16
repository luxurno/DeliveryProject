import React, {Component} from 'react';
import {Route, Switch, Redirect, Link, withRouter} from 'react-router-dom';
import Navbar from './Navbar/Navbar';
import AddDriver from "./Modules/AddDriver.module";
import RemoveDriver from "./Modules/RemoveDriver.module";
import ImportDelivery from "./Modules/ImportDelivery.module";
import Settings from "./Modules/Settings.module";
import RouteLookup from "./Modules/RouteLookup.module";
import RouteGenerator from "./Modules/RouteGenerator.module";
import SendingPerception from "./Modules/SendingPerception.module";

export default class HomeApp extends Component {
    render() {
        return (
            <div className={"home"}>
                <Navbar/>

                <Switch>
                    <Route path={"/add-driver"} component={AddDriver}/>
                    {/*<Route path={"/remove-driver"} component={RemoveDriver}/>*/}
                    <Route path={"/import-delivery"} component={ImportDelivery}/>
                    <Route path={"/settings"} component={Settings}/>
                    <Route path={"/route-lookup"} component={RouteLookup}/>
                    <Route path={"/route-generator"} component={RouteGenerator}/>
                    <Route path={"/sending-perception"} component={SendingPerception}/>
                </Switch>
            </div>
        );
    }
}
