import React, {Component} from 'react';

export default class SpinnerPage extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <>
                <div style={{display: this.props.isLoading ? 'flex' : 'none' }}
                     className="spinner-border" role="status">
                    <span className="sr-only">Loading...</span>
                </div>
            </>
        )
    }
}