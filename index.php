<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP| MySQL | React.js | Axios Example</title>
    <!-- include React -->
    <script src= "https://unpkg.com/react@16/umd/react.production.min.js"></script>
    <!-- include ReactDOM -->
    <script src= "https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
    <!-- Load Babel Compiler -->
    <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>
    <!-- Load Axios -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>
<body>
    <!-- Mount React application --->
    <div id="root">sdf</div>

    <script type="text/babel">
        //Create a React component by extending React.Component class
        class App extends React.Component {
            state = {
                //tracks variable will be used to hold tracks after we fetch from the PHP REST endpoint using Axios
                tracks: ['hello']
            }
            //render() returns a fragment
            render() {
                return (
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
        //Use render() to mount our App component to the DOM
        ReactDOM.render(<App />, document.getElementById('root'));
    </script>
</body>
</html>