import React, {Component} from 'react';
import SendingPerceptionForm from "./SendingPerception.form";
import {HeadersCustomBox} from "../../Core/Box/HeadersCustom.box";
import {HeadersEnum} from "../../Core/Text/Enum/Headers.enum";

export default class SendingPerceptionComponent extends Component {
    constructor(props) {
        super(props);

        this.state = {
            showNearBy: false,
        };
    }

    showNearByCallback = (showNearBy) => {
        this.setState({
            showNearBy: showNearBy,
        });
        this.props.moduleShowNearByCallback(this.state.showNearBy);
    };

    render() {
        return (
            <div
                style={{display: this.state.showNearBy ? 'none' : 'block' }}
                className={"wysylanie-odbioru-container"}
            >
                <HeadersCustomBox headersText={HeadersEnum.SENDING_PERCEPTION} />

                <SendingPerceptionForm data={this.props.data} showNearByCallback={this.showNearByCallback}/>
            </div>
        );
    }
}
