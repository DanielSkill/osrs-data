/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */
require('./bootstrap');

import React from 'react';
import ReactDOM from 'react-dom';
import PlayerPage from './views/player';
import HomePage from './views/home';
import { Provider } from 'react-redux';
import store from './store';
import { BrowserRouter as Router, Route, Switch } from "react-router-dom";

const App = () => {
  return (
    <Provider store={store}>
      <Router>
        <Switch>
          <Route path='/' exact component={HomePage} />
          <Route path='/player/:player' component={PlayerPage} />
        </Switch>
      </Router>
    </Provider>
  )
}

if (document.getElementById('app-root')) {
  ReactDOM.render(
      <App />,
    document.getElementById('app-root')
  );
}