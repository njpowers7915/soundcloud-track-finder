import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class App extends React.Component {
    state = {
        //tracks variable will be used to hold tracks after we fetch from the PHP REST endpoint using Axios
        tracks: []
    }
    //render() returns a fragment
    render() {
        return (
    //         <h1>test</h1>
    //     )
    // }
            <React.Fragment>
                <h1>SoundCloud Repost Finder</h1>
                <table border='1' width='100%' >
                    <tr>
                        <th>title</th>
                        <th>permalink</th>
                        <th>permalink_url</th>
                        <th>user</th>
                        <th>duration</th>
                        <th>genre</th>
                    </tr>

                    {this.state.tracks.map((track) => (
                        <tr>
                            <td>{ track.title }</td>
                            <td>{ track.permalink }</td>
                            <td>{ track.permalink_url }</td>
                            <td>{ track.user }</td>
                            <td>{ track.duration }</td>
                            <td>{ track.genre }</td>
                        </tr>
                    ))}
                </table>
            </React.Fragment>
        );
    }
    //Gets called when component is mounted in the DOM
    componentDidMount() {
        const url = '/api/tracks.php'
        axios.get(url).then(response => response.data)
        .then((data) => {
            this.setState({ tracks: data })
            console.log(this.state.tracks)
        })
        console.log('hello')
    }
}

export default App;