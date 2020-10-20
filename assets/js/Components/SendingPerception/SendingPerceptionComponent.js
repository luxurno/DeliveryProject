import React, {Component} from 'react';
import SendingPerceptionForm from "./SendingPerception.form";
import {HeadersCustomBox} from "../../Core/Box/HeadersCustom.box";
import {HeadersEnum} from "../../Core/Text/Enum/Headers.enum";

export default class SendingPerceptionComponent extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        let { name, showConfig } = this.props.data;
        let displayStyle = {};

        if (showConfig === false) {
            displayStyle = {
                display: "none",
            };
        }

        return (
            <div className={"wysylanie-odbioru-container"} style={displayStyle}>
                <HeadersCustomBox headersText={HeadersEnum.SENDING_PERCEPTION} />

                <SendingPerceptionForm data={this.props.data} />
            </div>
        );
    }
}
