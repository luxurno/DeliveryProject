import React, {Component} from 'react';
import {Route, Switch, Redirect, Link, withRouter} from 'react-router-dom';
import userIcon from '../../../img/user-icon.svg';

class Navbar extends Component {
    render() {
        return(
            <nav className={"navbar navbar-expand-lg"}>
                {/*<Link className={"navbar-brand"} to={"#"}>Analiza i projektowanie</Link>*/}


                <div className={"collapse navbar-collapse"} id={"navbarSupportedContent"}>
                    <ul className={"navbar-nav mr-auto"}>
                        <li className={"nav-item active navbar-brand-custom"}>
                            <Link className={"nav-link"} to={"#"}>Analiza i projektowanie</Link>
                        </li>
                        <li className={"nav-item"}>
                            <Link className={"nav-link"} to={"/konfiguracja"}>Konfiguracja</Link>
                        </li>
                        <li className={"nav-item"}>
                            <Link className={"nav-link"} to={"/podglad-trasy"}>Podgląd trasy</Link>
                        </li>
                        <li className={"nav-item"}>
                            <Link className={"nav-link"} to={"/generator-trasy"}>Generator trasy</Link>
                        </li>
                        <li className={"nav-item"}>
                            <Link className={"nav-link"} to={"/wysylanie-odbioru"}>Wysyłanie odbioru</Link>
                        </li>

                        <li className="nav-item dropdown">
                            <img src={userIcon} />
                            <Link className="nav-link dropdown-toggle" to={"#"} id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            </Link>
                            <div className="dropdown-menu" aria-labelledby="navbarDropdown">
                                <Link className="dropdown-item" to={"/konfiguracja"}>Konfiguracja</Link>
                                <Link className="dropdown-item" to={"/podglad-trasy"}>Podgląd trasy</Link>
                                <div className="dropdown-divider" />
                                <Link className="dropdown-item" to={"/generator-trasy"}>Generator trasy</Link>
                                <Link className="dropdown-item" to={"/wysylanie-odbioru"}>Wysyłanie odbioru</Link>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        );
    }
}

export default Navbar;