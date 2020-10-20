import React, {Component} from 'react';
import {Route, Switch, Redirect, Link, withRouter} from 'react-router-dom';
import userIcon from '../../img/user-icon.svg';

class Navbar extends Component {
    render() {
        return(
            <nav className={"navbar navbar-expand-lg"}>
                <div className={"collapse navbar-collapse"} id={"navbarSupportedContent"}>
                    <ul className={"navbar-nav mr-auto"}>
                        <li className={"nav-item active navbar-brand-custom"}>
                            <Link className={"nav-link"} to={"/"}>Luxurno</Link>
                        </li>
                        <li className={"nav-item"}>
                            <Link className={"nav-link"} to={"/settings"}>Konfiguracja</Link>
                        </li>
                        <li className={"nav-item"}>
                            <Link className={"nav-link"} to={"/import-delivery"}>Import dostaw</Link>
                        </li>
                        <li className={"nav-item"}>
                            <Link className={"nav-link"} to={"/route-generator"}>Generator trasy</Link>
                        </li>
                        <li className={"nav-item"}>
                            <Link className={"nav-link"} to={"/route-lookup"}>Podgląd trasy</Link>
                        </li>
                        <li className={"nav-item"}>
                            <Link className={"nav-link"} to={"/sending-perception"}>Wysyłanie odbioru</Link>
                        </li>
                        <li className="nav-item dropdown">
                            <img src={userIcon} />
                            <Link className="nav-link dropdown-toggle" to={"#"} id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </Link>
                            <div className="dropdown-menu" aria-labelledby="navbarDropdown">
                                <Link className="dropdown-item" to={"/settings"}>Konfiguracja</Link>
                                <Link className="dropdown-item" to={"/import-delivery"}>Import dostaw</Link>
                                <Link className="dropdown-item" to={"/route-generator"}>Generator trasy</Link>
                                <Link className="dropdown-item" to={"/route-lookup"}>Podgląd trasy</Link>
                                <Link className="dropdown-item" to={"/sending-perception"}>Wysyłanie odbioru</Link>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        );
    }
}

export default Navbar;
