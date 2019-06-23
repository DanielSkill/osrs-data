import {
  ADD_PLAYER
} from './actionTypes'

export function addPlayer(payload) {
  return { type: ADD_PLAYER, payload }
}