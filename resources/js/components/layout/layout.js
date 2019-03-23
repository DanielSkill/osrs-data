import React from 'react';
import { Layout, Menu } from 'antd';

const { Header, Content } = Layout;

const DefaultLayout = (props) => {
  return  (
    <Layout>
      <Header style={{ position: 'fixed', zIndex: 1000, width: '100%' }}>
        <div className="logo" />
        <Menu
          theme="dark"
          mode="horizontal"
          defaultSelectedKeys={['1']}
          style={{ lineHeight: '64px' }}
          >
          <Menu.Item key="1">Home</Menu.Item>
          <Menu.Item key="2">Records</Menu.Item>
          <Menu.Item key="3">Current</Menu.Item>
        </Menu>
      </Header>
      <Content style={{ padding: '0 50px', marginTop: 64 }}>
        <div style={{ background: '#fff', padding: 24, minHeight: '100vh' }}>
          {props.children}
        </div>
      </Content>
    </Layout>
  )
}

export default DefaultLayout