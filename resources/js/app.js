
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */
require('./bootstrap');

import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import playerService from './services/player';

export default class App extends Component {
  state = {
    player: {}
  }
  
  componentDidMount() {
    axios.get('/api/stats/player/SalvationDMS')
    .then((res) => {
      this.setState({
        player: res.data.data
      })
      console.log(playerService.getGainsInPeriod(res.data.data, '2019-03-06', '2019-03-07'))
    });
  }

  render() {
    return (
      <div>Hello World</div>
    );
  }
}

if (document.getElementById('app-root')) {
  ReactDOM.render(<App />, document.getElementById('app-root'));
}

