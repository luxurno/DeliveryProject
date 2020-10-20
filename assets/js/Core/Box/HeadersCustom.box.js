import React, {Component} from 'react';

export class HeadersCustomBox extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <div className={"d-flex justify-content-center"}>
                <div className={"modules-header-text"}>
                    {this.props.headersText}
                </div>
            </div>
        );
    }
}
