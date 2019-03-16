const addItem = (key, item) => {
  let storedItems = JSON.parse(localStorage.getItem(key));

  if (storedItems == null) {
    storedItems = []
  }

  const allItems = [...storedItems, item]

  // don't store duplicates
  if (! storedItems.includes(item)) {
    localStorage.setItem(key, JSON.stringify(allItems))
  }
}

const getItem = (key, defaultValue) => {
  const item = localStorage.getItem(key)

  if (item == null && defaultValue !== null) {
    return defaultValue
  }

  return item
} 

export default {
  addItem,
  getItem
}