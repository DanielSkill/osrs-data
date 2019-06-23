import React, { Component } from 'react';
import { AutoComplete, Form } from 'antd';
import localStorage from '../../services/localStorage';
import { withRouter } from 'react-router';

class HeaderSearch extends Component {
  state = {
    search: ""
  }

  handleChange = (value) => {
    this.setState({ search: value })
  }

  handleSubmit = (e) => {
    e.preventDefault()
    this.changePage()
  }

  changePage = (value) => {
    this.props.history.push(`/player/${value ? value : this.state.search}`)
  }

  render() {
    return (
      <form onSubmit={this.handleSubmit}>
        <AutoComplete
          onSelect={this.changePage}
          value={this.state.search}
          placeholder="Search..."
          dataSource={localStorage.getItem('searches', [])}
          onChange={this.handleChange}
          style={{ width: 200 }}
          filterOption
          allowClear
        />
      </form>
    )
  }
}

export default withRouter(HeaderSearch)
