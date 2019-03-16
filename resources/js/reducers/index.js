import { combineReducers } from 'redux';
import playerReducer from './playerReduer';

export default combineReducers({
  playerReducer: playerReducer
})