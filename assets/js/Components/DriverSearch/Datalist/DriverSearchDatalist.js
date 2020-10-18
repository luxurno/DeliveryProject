import React, {Component} from 'react';
import axios from 'axios';

export default class DriverSearchDatalist extends Component {
    constructor(props) {
        super(props);

        this.state = {
            drivers: null,
            refEl: null
        };

        this.handleSearch = this.handleSearch.bind(this);
        this.handleSearch();
    }

    handleSearch() {
        axios.get(process.env.APP_DOMAIN + '/api/drivers').then(res => {
            const drivers = res.data;
            this.setState({ drivers: drivers });
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
