const initialState = {
  players: []
};

function playerReducer(state = initialState, action) {
  switch (action.type) {
    case 'ADD_PLAYER':
      return {
        ...state,
        players: [...state.players, action.payload]
      }
    default:
      return state
  }
}

export default playerReducer