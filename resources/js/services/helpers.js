export const formatStatistic = (statistic, suffix) => {
  return formatNumber(statistic) + ` (${formatNumber(suffix)})`;
}

export const formatNumber = number => {
  return String(number).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}