import React, {Component} from 'react';

export default class ScreenPopup extends Component {
    constructor(props) {
        super(props);

        this.divRef = React.createRef();
    }

    handleClose(event) {
        this.divRef.current.querySelector(':last-child').remove();
    }

    render() {
        if (this.props.status !== null) {
            if (this.divRef.current !== null) {
                setTimeout( () => {
                    if (this.divRef.current.querySelector(":last-child") === null) {
                        this.divRef.current.insertAdjacentHTML("beforeend", '' +
                            '<p class="screen-popup">' +
                            '<span class="modules-header-text">' +
                            this.props.status +
                            '</span>' +
                            '</p>'
                        );
                        setTimeout( () => {
                            this.divRef.current.querySelector(':last-child').remove();
                        }, 1400);
                    }
                }, 200);
            }
        }

        return (
            <div ref={this.divRef}>
            </div>
        );
    }
}
