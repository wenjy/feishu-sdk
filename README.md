## 简介

内核代码架构来自：（[https://github.com/w7corp/easywechat](https://github.com/w7corp/easywechat)）

飞书 ([https://feishu.cn](https://feishu.cn)) 服务接口 Sdk.

## 文档
飞书服务接口文档 ([https://open.feishu.cn/document/ukTMukTMukTM/uADN14CM0UjLwQTN](https://open.feishu.cn/document/ukTMukTMukTM/uADN14CM0UjLwQTN))

## 功能
- [ ] 授权
    - [ ] 获取 app_access_token（企业自建应用）
    - [ ] 获取 app_access_token（应用商店应用）
    - [ ] 获取 tenant_access_token（企业自建应用）
    - [ ] 获取 tenant_access_token（应用商店应用）
    - [ ] 重新推送 app_ticket
    - [ ] [查询租户授权状态](https://bytedance.feishu.cn/docs/doccnHJx2UbLZh5kiWjNawICyNd#dCNL6V)
    - [ ] [申请授权](https://bytedance.feishu.cn/docs/doccnHJx2UbLZh5kiWjNawICyNd#kHHiAa)
- [ ] 身份验证
    - [ ] 请求身份验证
    - [ ] 获取登录用户身份
    - [ ] 刷新access_token
    - [ ] 获取用户信息
- [ ] 通讯录
    - [ ] 获取通讯录授权范围
    - [ ] 获取子部门列表
    - [ ] 获取子部门 ID 列表
    - [ ] 获取部门详情
    - [ ] 批量获取部门详情
    - [ ] 获取部门用户列表
    - [ ] 获取部门用户详情
    - [ ] 获取企业自定义用户属性配置
    - [ ] 批量获取用户信息
    - [ ] 新增用户
    - [ ] 更新用户信息
    - [ ] 删除用户
    - [ ] 新增部门
    - [ ] 更新部门信息
    - [ ] 删除部门
    - [ ] 批量新增用户
    - [ ] 批量新增部门
    - [ ] 查询批量任务执行状态
    - [ ] 获取应用管理员管理范围
    - [ ] 获取角色列表
    - [ ] 获取角色成员列表
- [ ] 用户信息
    - [ ] 使用手机号或邮箱获取用户 ID
- [ ] 应用信息
    - [ ] 获取应用管理权限
    - [ ] 获取应用在企业内的可用范围
    - [ ] 获取用户可用的应用
    - [ ] 获取企业安装的应用
    - [ ] 更新应用可用范围
    - [ ] 设置用户可用应用
- [ ] 应用商店计费信息
    - [ ] 查询用户是否在应用开通范围
    - [ ] 查询租户购买的付费方案
    - [ ] 查询订单详情
- [ ] 群组
    - [ ] 获取用户所在的群列表
    - [ ] 获取群成员列表
    - [ ] 搜索用户所在的群列表
- [ ] 机器人
    - [ ] 批量发送消息
    - [ ] 发送文本消息
    - [ ] 发送图片消息
    - [ ] 发送富文本消息
    - [ ] 发送群名片
    - [ ] 消息撤回
    - [ ] 发送卡片通知
    - [ ] 群信息和群管理
        - [ ] 创建群
        - [ ] 获取群列表
        - [ ] 获取群信息
        - [ ] 更新群信息
        - [ ] 拉用户进群
        - [ ] 移除用户出群
        - [ ] 解散群
    - [ ] 机器人信息与管理
        - [ ] 拉机器人进群
- [ ] 日历
    - [ ] 获取日历
    - [ ] 获取日历列表
    - [ ] 创建日历
    - [ ] 删除日历
    - [ ] 更新日历
    - [ ] 获取日程
    - [ ] 创建日程
    - [ ] 获取日程列表
    - [ ] 删除日程
    - [ ] 更新日程
    - [ ] 邀请/移除日程参与者
- [ ] 企业
    - [ ] 获取企业信息

## 参考
* 飞书官方文档 https://open.feishu.cn/document/uQjL04CN/ucDOz4yN4MjL3gzM
