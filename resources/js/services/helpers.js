export const formatXp = xp => {
  return String(xp).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}