import React, {Component} from 'react';
import axios from 'axios';
import {StorageService} from "../../../Core/Service/Storage.service";

export default class DriverSearchDatalist extends Component {
    storageService$: StorageService = new StorageService();

    constructor(props) {
        super(props);

        this.state = {
            drivers: null,
            refEl: null,
            available: null,
            disable: false,
        };

        if (props.available) {
            this.state.available = this.props.available;
        }

        this.handleSearch = this.handleSearch.bind(this);
        this.handleSearch();
    }

    handleSearch() {
        let userId = this.storageService$.getCurrentUserId();
        let available = '';

        if (this.state.available) {
            available = '&available=' + this.state.available;
        }

        axios
            .get(
                process.env.APP_DOMAIN + '/api/drivers?userId=' + userId + available,
            )
            .then(res => {
                const drivers = res.data;
                this.setState({ drivers: drivers });

                if (0 === res.data.length) {
                    this.setState({ disable: true });
                    this.props.callback(this.state);
                }
            });
    }

    render() {
        if (this.state.drivers !== null) {
            if (this.refEl.querySelector(":last-child") === null) {
                for (let index in this.state.drivers) {
                    this.refEl.insertAdjacentHTML("beforeend",
                        '<option key="' + this.state.drivers[index].id + '" value="' + this.state.drivers[index].id + ". " + this.state.drivers[index].name + '" />'
                    );
                }
            }
        }

        return(
            <datalist id={"drivers"} ref={refEl => {
                this.refEl = refEl
            }}>
            </datalist>
        );
    }
}
